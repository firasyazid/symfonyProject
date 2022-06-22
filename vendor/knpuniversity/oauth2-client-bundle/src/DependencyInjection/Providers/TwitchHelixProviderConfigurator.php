<?php

/*
 * OAuth2 Client Bundle
 * Copyright (c) KnpUniversity <http://knpuniversity.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KnpU\OAuth2ClientBundle\DependencyInjection\Providers;

use KnpU\OAuth2ClientBundle\Client\Provider\TwitchHelixClient;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Vertisan\OAuth2\Client\Provider\TwitchHelix;

/**
 * @Author Erdem Uyanik
 */
class TwitchHelixProviderConfigurator implements ProviderConfiguratorInterface
{
    public function buildConfiguration(NodeBuilder $node)
    {
        // no custom options
    }

    public function getProviderClass(array $config)
    {
        return TwitchHelix::class;
    }

    public function getProviderOptions(array $config)
    {
        return [
            'clientId' => $config['client_id'],
            'clientSecret' => $config['client_secret'],
        ];
    }

    public function getPackagistName()
    {
        return 'vertisan/oauth2-twitch-helix';
    }

    public function getLibraryHomepage()
    {
        return 'https://github.com/vertisan/oauth2-twitch-helix';
    }

    public function getProviderDisplayName()
    {
        return 'Twitch Helix';
    }

    public function getClientClass(array $config)
    {
        return TwitchHelixClient::class;
    }
}
