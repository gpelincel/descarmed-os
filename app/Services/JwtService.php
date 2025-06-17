<?php

namespace App\Services;

use App\Models\Usuario;
use DateTimeImmutable;
use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Constraint\ValidAt;
use Lcobucci\JWT\UnencryptedToken;

class JwtService
{
    private Configuration $config;

    public function __construct()
    {
        $signer = new Sha256();
        $key = InMemory::plainText(env('JWT_SECRET'));

        $this->config = Configuration::forSymmetricSigner($signer, $key);

        $this->config->setValidationConstraints(
            new SignedWith($signer, $key),
            new ValidAt(SystemClock::fromUTC())
        );
    }

    public function generateToken(Usuario $user): string
    {
        $now = new DateTimeImmutable();

        return $this->config->builder()
            ->issuedAt($now)
            ->expiresAt($now->modify('+1 hour'))
            ->withClaim('uid', $user->id)
            ->getToken($this->config->signer(), $this->config->signingKey())
            ->toString();
    }

    public function parseToken(string $token): ?int
    {
        try {
            /** @var UnencryptedToken $parsed */
            $parsed = $this->config->parser()->parse($token);

            $constraints = $this->config->validationConstraints();
            if (empty($constraints)) {
                // Segurança: nunca valide sem constraints
                return null;
            }

            if (!$this->config->validator()->validate($parsed, ...$constraints)) {
                return null;
            }

            return $parsed->claims()->get('uid');
        } catch (\Throwable $e) {
            // Se quiser debugar, use: return $e->getMessage();
            return null;
        }
    }
}
