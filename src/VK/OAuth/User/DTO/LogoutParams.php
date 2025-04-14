<?php

declare(strict_types = 1);

namespace VK\OAuth\User\DTO;

class LogoutParams
{
    private const PARAM_CLIENT_ID = 'client_id';
    private const PARAM_ACCESS_TOKEN = 'access_token';
    private const PARAM_VIEW_TYPE = 'view_type';

    /**
     * @var int
     */
    private int $client_id;

    /**
     * @var string
     */
    private string $access_token;

    /**
     * @var string
     */
    private string $view_type = ViewType::VIEW_TYPE_RFC;

    /**
     * @param int    $client_id
     * @param string $access_token
     */
    public function __construct(int $client_id, string $access_token)
    {
        $this->client_id = $client_id;
        $this->access_token = $access_token;
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
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @return string
     */
    public function getViewType(): string
    {
        return $this->view_type;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $params = [
            self::PARAM_CLIENT_ID           => $this->client_id,
            self::PARAM_ACCESS_TOKEN        => $this->access_token,
        ];

        if ($this->view_type != ViewType::VIEW_TYPE_RFC) {
            $params[self::PARAM_VIEW_TYPE] = $this->view_type;
        }

        return $params;
    }
}
