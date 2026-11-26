<?php

declare(strict_types=1);

namespace App\Modules\Identity\Presentation\Web;

use App\Modules\Identity\Application\Authentication;
use App\Modules\Identity\Infrastructure\Accounts;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\RequestProvider\RequestProviderInterface;
use Yiisoft\Router\CurrentRoute;
use Yiisoft\Yii\View\Renderer\WebViewRenderer;

final readonly class AuthAction
{
    public function __construct(
        private Authentication $auth,
        private Accounts $accounts,
        private RequestProviderInterface $requests,
        private CurrentRoute $route,
        private WebViewRenderer $views,
        private ResponseFactoryInterface $responses,
    ) {}

    public function __invoke(): ResponseInterface
    {
        $request = $this->requests->get();
        $mode = $this->route->getArgument('mode') ?? '';
        if (!in_array($mode, ['login', 'register', 'logout'], true)) {
            return $this->responses->createResponse(404);
        }
        if ($mode === 'logout') {
            if ($request->getMethod() !== 'POST') {
                return $this->responses->createResponse(405)->withHeader('Allow', 'POST');
            }
            $this->auth->logout();
            return $this->responses->createResponse(303)->withHeader('Location', '/');
        }
        $error = '';
        $email = '';
        $name = '';
        if ($request->getMethod() === 'POST') {
            $body = $request->getParsedBody();
            $body = is_array($body) ? $body : [];
            $email = is_string($body['email'] ?? null) ? Authentication::normalizeEmail($body['email']) : '';
            $name = is_string($body['name'] ?? null) ? trim($body['name']) : '';
            $password = is_string($body['password'] ?? null) ? $body['password'] : '';
            $ip = $request->getServerParams()['REMOTE_ADDR'] ?? '';
            if (!is_string($ip) || $ip === '') {
                $ip = 'unknown';
            }
            if (!$this->accounts->allowAttempt($mode, $ip)) {
                $error = 'Слишком много попыток. Попробуйте через 15 минут.';
            } elseif ($mode === 'register') {
                if (strlen($email) > 254 || filter_var($email, FILTER_VALIDATE_EMAIL) === false || mb_strlen($name) < 2 || mb_strlen($name) > 100 || strlen($password) < 12 || strlen($password) > 72) {
                    $error = 'Укажите имя (2–100 символов), корректный email и пароль длиной от 12 до 72 байт.';
                } elseif (!$this->accounts->create($email, $name, password_hash($password, PASSWORD_DEFAULT))) {
                    $error = 'Не удалось зарегистрировать аккаунт. Проверьте данные или войдите.';
                } else {
                    $this->auth->login($email, $password);
                    return $this->responses->createResponse(303)->withHeader('Location', '/account');
                }
            } elseif (strlen($email) <= 254 && strlen($password) <= 72 && $this->auth->login($email, $password)) {
                return $this->responses->createResponse(303)->withHeader('Location', '/account');
            } else {
                $error = 'Неверный email или пароль.';
            }
        }
        return $this->views->render(__DIR__ . '/auth', compact('mode', 'error', 'email', 'name'))
            ->withHeader('Cache-Control', 'no-store');
    }
}
