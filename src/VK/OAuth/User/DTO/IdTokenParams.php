<?php

declare(strict_types = 1);

namespace VK\OAuth\User\DTO;

class IdTokenParams
{
    private const PARAM_CLIENT_ID = 'client_id';
    private const PARAM_ID_TOKEN = 'id_token';
    private const PARAM_VIEW_TYPE = 'view_type';

    /**
     * @var int
     */
    private int $client_id;

    /**
     * @var string
     */
    private string $id_token;

    /**
     * @var string
     */
    private string $view_type = ViewType::VIEW_TYPE_RFC;

    /**
     * @param int    $client_id
     * @param string $id_token
     */
    public function __construct(int $client_id, string $id_token)
    {
        $this->client_id = $client_id;
        $this->id_token = $id_token;
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
    public function getIdToken(): string
    {
        return $this->id_token;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $params = [
            self::PARAM_CLIENT_ID => $this->client_id,
            self::PARAM_ID_TOKEN => $this->id_token,
        ];

        if ($this->view_type != ViewType::VIEW_TYPE_RFC) {
            $params[self::PARAM_VIEW_TYPE] = $this->view_type;
        }

        return $params;
    }
}