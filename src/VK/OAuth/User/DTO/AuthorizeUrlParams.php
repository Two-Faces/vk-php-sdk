<?php

declare(strict_types = 1);

namespace VK\OAuth\User\DTO;

use VK\OAuth\ResponseType;

class AuthorizeUrlParams
{
    /** prompts values  */
    public const PROMPT_DEFAULT = '';
    public const PROMPT_NONE = 'none';
    public const PROMPT_LOGIN = 'login';
    public const PROMPT_CONSENT = 'consent';
    public const PROMPT_SELECT_ACCOUNT = 'select_account';

    /** provider values */
    public const PROVIDER_VKID = 'vkid';
    public const PROVIDER_OK = 'ok_ru';
    public const PROVIDER_MAIL = 'mail_ru';

    /** available languages */
    public const LANG_RUS = 0;
    public const LANG_UKR = 1;
    public const LANG_ENG = 3;
    public const LANG_SPA = 4; // Spanish
    public const LANG_DEU = 6; // German
    public const LANG_POL = 15; // Polish
    public const LANG_FRA = 16; // French
    public const LANG_TUR = 82; // Turkish

    /** available color schemes */
    public const SCHEME_LIGHT = 'light';
    public const SCHEME_DARK  = 'dark';

    /** url param names */
    private const PARAM_RESPONSE_TYPE  = 'response_type';
    private const PARAM_CLIENT_ID = 'client_id';
    private const PARAM_CODE_CHALLENGE = 'code_challenge';
    private const PARAM_CODE_CHALLENGE_METHOD = 'code_challenge_method';
    private const PARAM_REDIRECT_URI = 'redirect_uri';
    private const PARAM_SCOPE = 'scope';
    private const PARAM_STATE = 'state';
    private const PARAM_PROMPT = 'prompt';
    private const PARAM_PROVIDER = 'provider';
    private const PARAM_LANG_ID = 'lang_id';
    private const PARAM_SCHEME = 'scheme';

    /**
     * @var string
     * @see ResponseType
     */
    protected string $response_type = ResponseType::CODE;

    /**
     * @var int
     */
    protected int $client_id;

    /**
     * @var string
     */
    protected string $code_challenge;

    /**
     * @var string
     */
    protected string $code_challenge_method = 'S256';

    /**
     * @var string
     */
    protected string $redirect_uri;

    /**
     * @var string
     */
    protected string $state;

    /**
     * @var string[]
     */
    protected array $scopes = [Scopes::PERSONAL_INFO];

    /**
     * @var string
     */
    protected string $prompt = self::PROMPT_DEFAULT;

    /**
     * @var string
     */
    protected string $provider = self::PROVIDER_VKID;

    /**
     * @var int
     */
    protected int $lang_id = self::LANG_RUS;

    /**
     * @var string
     */
    protected string $scheme = self::SCHEME_LIGHT;

    /**
     * @param int $client_id
     * @param string $verifier
     * @param string $redirect_uri
     * @param string $state
     */
    public function __construct(int $client_id, string $verifier, string $redirect_uri, string $state)
    {
        $this->client_id = $client_id;
        $this->redirect_uri = $redirect_uri;
        $this->state = $state;

        $code_challenge = hash('sha256', $verifier, true);
        $code_challenge = rtrim(strtr(base64_encode($code_challenge), '+/', '-_'), '=');
        $this->code_challenge = $code_challenge;
    }

    /**
     * @return string[]
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }

    /**
     * @param string[] $scopes
     * @return $this
     */
    public function setScopes(array $scopes): self
    {
        $this->scopes = $scopes;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrompt(): string
    {
        return $this->prompt;
    }

    /**
     * @param string $prompt
     * @return $this
     */
    public function setPrompt(string $prompt): self
    {
        $this->prompt = $prompt;
        return $this;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     * @return $this
     */
    public function setProvider(string $provider): self
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * @return int
     */
    public function getLangId(): int
    {
        return $this->lang_id;
    }

    /**
     * @param int $lang_id
     * @return $this
     */
    public function setLangId(int $lang_id): self
    {
        $this->lang_id = $lang_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @param string $scheme
     * @return $this
     */
    public function setScheme(string $scheme): self
    {
        $this->scheme = $scheme;
        return $this;
    }

    /**
     * @return string
     */
    public function getResponseType(): string
    {
        return $this->response_type;
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
    public function getCodeChallenge(): string
    {
        return $this->code_challenge;
    }

    /**
     * @return string
     */
    public function getCodeChallengeMethod(): string
    {
        return $this->code_challenge_method;
    }

    /**
     * @return string
     */
    public function getRedirectUri(): string
    {
        return $this->redirect_uri;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            self::PARAM_RESPONSE_TYPE         => $this->response_type,
            self::PARAM_CLIENT_ID             => $this->client_id,
            self::PARAM_CODE_CHALLENGE        => $this->code_challenge,
            self::PARAM_CODE_CHALLENGE_METHOD => $this->code_challenge_method,
            self::PARAM_REDIRECT_URI          => $this->redirect_uri,
            self::PARAM_SCOPE                 => implode(' ', $this->scopes),
            self::PARAM_STATE                 => $this->state,
            self::PARAM_PROMPT                => $this->prompt,
            self::PARAM_PROVIDER              => $this->provider,
            self::PARAM_LANG_ID               => $this->lang_id,
            self::PARAM_SCHEME                => $this->scheme,
        ];
    }
}
