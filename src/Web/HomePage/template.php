<?php

declare(strict_types=1);

use App\Shared\ApplicationParams;
use Yiisoft\View\WebView;

/** @var WebView $this */
/** @var ApplicationParams $applicationParams */
$this->setTitle($applicationParams->name);
?>
<section class="hero">
    <p class="eyebrow">Локальное IT-сообщество</p>
    <h1>SITC</h1>
    <p>Место, где знакомятся, делятся знаниями и создают новое вместе.</p>
    <p class="note">Сайт сообщества находится в разработке.</p>
</section>
