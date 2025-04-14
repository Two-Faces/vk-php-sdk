<?php

declare(strict_types = 1);

namespace VK\OAuth\User\DTO;

class RefreshTokensParams
{
    /** grant type value */
    public const GRANT_TYPE = 'refresh_token';

    /** param names */
    private const PARAM_GRANT_TYPE = 'grant_type';
    private const PARAM_CLIENT_ID = 'client_id';
    private const PARAM_SCOPE = 'scope';
    private const PARAM_REFRESH_TOKEN = 'refresh_token';
    private const PARAM_DEVICE_ID = 'device_id';
    private const PARAM_IP_ADDRESS = 'ip';
    private const PARAM_VIEW_TYPE = 'view_type';

    /**
     * @var int
     */
    private int $client_id;

    /**
     * @var string
     */
    private string $refresh_token;

    /**
     * @var string
     */
    private string $device_id;

    /**
     * @var string
     */
    private string $scope = '';

    /**
     * @var string
     */
    private string $ip = '';

    /**
     * @var string
     */
    private string $view_type = ViewType::VIEW_TYPE_RFC;

    /**
     * @param int    $client_id
     * @param string $refresh_token
     * @param string $device_id
     */
    public function __construct(int $client_id, string $refresh_token, string $device_id)
    {
        $this->client_id = $client_id;
        $this->refresh_token = $refresh_token;
        $this->device_id = $device_id;
    }

    /**
     * @return string
     */
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * @param string $scope
     * @return $this
     */
    public function setScope(string $scope): self
    {
        $this->scope = $scope;
        return $this;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     * @return $this
     */
    public function setIp(string $ip): self
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return string
     */
    public function getViewType(): string
    {
        return $this->view_type;
    }

    /**
     * @param string $view_type
     * @return $this
     */
    public function setViewType(string $view_type): self
    {
        $this->view_type = $view_type;
        return $this;
    }

    /**
     * @return int
     */
    public function getClientId(): int
    {
        return $this->client_id;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refresh_token;
    }

    /**
     * @return string
     */
    public function getDeviceId(): string
    {
        return $this->device_id;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
      $params = [
        self::PARAM_GRANT_TYPE => self::GRANT_TYPE,
        self::PARAM_CLIENT_ID => $this->client_id,
        self::PARAM_REFRESH_TOKEN => $this->refresh_token,
        self::PARAM_DEVICE_ID => $this->device_id,
      ];

      if ($this->scope) {
        $params[self::PARAM_SCOPE] = $this->scope;
      }

      if ($this->ip) {
        $params[self::PARAM_IP_ADDRESS] = $this->ip;
      }

      if ($this->view_type != ViewType::VIEW_TYPE_RFC) {
        $params[self::PARAM_VIEW_TYPE] = $this->view_type;
      }

      return $params;
    }
}
