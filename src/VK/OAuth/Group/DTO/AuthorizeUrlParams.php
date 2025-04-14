<?php

declare(strict_types = 1);

namespace VK\OAuth\Group\DTO;

use VK\OAuth\Group\Display;
use VK\OAuth\Group\Scopes;
use VK\OAuth\ResponseType;

class AuthorizeUrlParams
{
    private const PARAM_VERSION = 'v';
    private const PARAM_CLIENT_ID = 'client_id';
    private const PARAM_REDIRECT_URI = 'redirect_uri';
    private const PARAM_GROUP_IDS = 'group_ids';
    private const PARAM_DISPLAY = 'display';
    private const PARAM_SCOPE = 'scope';
    private const PARAM_RESPONSE_TYPE = 'response_type';
    private const PARAM_STATE = 'state';
    private const PARAM_REVOKE = 'revoke';

    /**
     * @var string
     * @see ResponseType
     */
    protected string $responseType;

    /**
     * @var int
     */
    protected int $clientId;

    /**
     * @var string
     */
    protected string $redirectUri;

    /**
     * @var string
     * @see Display
     */
    protected string $display;

    /**
     * @var string
     */
    protected string $state;

    /**
     * @var int[]
     * @see Scopes
     */
    protected array $scopes = [];

    /**
     * @var int[]
     */
    protected array $groupIds = [];

    /**
     * @var bool
     */
    protected bool $revoke = false;

    public function __construct(string $responseType, int $clientId, string $redirectUri, string $display, string $state)
    {
        $this->responseType = $responseType;
        $this->clientId = $clientId;
        $this->redirectUri = $redirectUri;
        $this->display = $display;
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getResponseType(): string
    {
        return $this->responseType;
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
    public function getRedirectUri(): string
    {
        return $this->redirectUri;
    }

    /**
     * @return string
     */
    public function getDisplay(): string
    {
        return $this->display;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return int[]
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }

    /**
     * @param int[] $scopes
     * @return $this
     * @see Scopes
     */
    public function setScopes(array $scopes): self
    {
        $this->scopes = $scopes;
        return $this;
    }

    /**
     * @return int[]
     */
    public function getGroupIds(): array
    {
        return $this->groupIds;
    }

    /**
     * @param int[] $groupIds
     * @return $this
     */
    public function setGroupIds(array $groupIds): self
    {
        $this->groupIds = $groupIds;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRevoke(): bool
    {
        return $this->revoke;
    }

    /**
     * @param bool $revoke
     * @return $this
     */
    public function setRevoke(bool $revoke = true): self
    {
        $this->revoke = $revoke;
        return $this;
    }

    /**
     * @param string $version
     * @return array<string, mixed>
     */
    public function toArray(string $version): array
    {
        $mask = 0;
        foreach ($this->getScopes() as $scope) {
            $mask |= $scope;
        }

        $params = [
            static::PARAM_CLIENT_ID => $this->getClientId(),
            static::PARAM_REDIRECT_URI => $this->getRedirectUri(),
            static::PARAM_DISPLAY => $this->getDisplay(),
            static::PARAM_SCOPE => $mask,
            static::PARAM_STATE => $this->getState(),
            static::PARAM_RESPONSE_TYPE => $this->getResponseType(),
            static::PARAM_VERSION => $version,
        ];

        if ($this->getGroupIds()) {
            $params[static::PARAM_GROUP_IDS] = implode(',', $this->getGroupIds());
        }

        if ($this->isRevoke()) {
            $params[static::PARAM_REVOKE] = 1;
        }

        return $params;
    }
}
