<?php

namespace App\Application\Query\ActivationToken;

class ActivationTokenView
{
    /** @var string */
    private $id;

    /** @var string */
    private $token;

    /** @var string */
    private $user;

    /** @var string */
    private $created_at;

    /** @var string|null */
    private $updated_at;

    /**
     * ActivationTokenView constructor.
     *
     * @param string $id
     * @param string $token
     * @param string $user
     * @param string $created_at
     * @param string|null $updated_at
     */
    public function __construct(string $id, string $token, string $user, string $created_at, ?string $updated_at)
    {
        $this->id = $id;
        $this->token = $token;
        $this->user = $user;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}
