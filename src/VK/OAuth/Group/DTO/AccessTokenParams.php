<?php

declare(strict_types = 1);

namespace VK\OAuth\Group\DTO;

class AccessTokenParams
{
    private const PARAM_CLIENT_ID = 'client_id';
    private const PARAM_REDIRECT_URI = 'redirect_uri';
    private const PARAM_CLIENT_SECRET = 'client_secret';
    private const PARAM_CODE = 'code';

    /**
     * @var int
     */
    protected int $clientId;

    /**
     * @var string
     */
    protected string $clientSecret;

    /**
     * @var string
     */
    protected string $redirectUri;

    /**
     * @var string
     */
    protected string $code;

    /**
     * @param int $clientId
     * @param string $clientSecret
     * @param string $redirectUri
     * @param string $code
     */
    public function __construct(int $clientId, string $clientSecret, string $redirectUri, string $code)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUri = $redirectUri;
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getClientId(): int
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @return string
     */
    public function getRedirectUri(): string
    {
        return $this->redirectUri;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            static::PARAM_CLIENT_ID => $this->clientId,
            static::PARAM_CLIENT_SECRET => $this->clientSecret,
            static::PARAM_REDIRECT_URI => $this->redirectUri,
            static::PARAM_CODE => $this->code,
        ];
    }
}
