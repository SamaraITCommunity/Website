<?php

declare(strict_types=1);

namespace App\Modules\Identity\Presentation\Web;

use App\Modules\Identity\Application\Authentication;
use App\Modules\Identity\Domain\Permissions;
use App\Modules\Identity\Infrastructure\Accounts;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\Router\CurrentRoute;
use Yiisoft\Yii\View\Renderer\WebViewRenderer;

final readonly class AccountAction
{
    public function __construct(private Authentication $auth, private Accounts $accounts, private CurrentRoute $route, private WebViewRenderer $views, private ResponseFactoryInterface $responses) {}

    public function __invoke(): ResponseInterface
    {
        $account = $this->auth->currentUser();
        if ($account === null) {
            return $this->responses->createResponse(303)->withHeader('Location', '/auth/login');
        }
        $permission = match ($this->route->getName()) {
            'identity.admin' => 'access.manage',
            'identity.moderation' => 'content.moderate',
            default => 'account.view',
        };
        if (!Permissions::allows($account['access_role'], $permission)) {
            return $this->responses->createResponse(403)->withHeader('Cache-Control', 'no-store');
        }
        $roles = $this->accounts->activeCommunityRoles((int) $account['id']);
        return $this->views->render(__DIR__ . '/account', compact('account', 'roles', 'permission'))
            ->withHeader('Cache-Control', 'no-store');
    }
}
