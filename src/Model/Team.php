<?php
declare(strict_types=1);
namespace Eddypouw\FootballDataApi\Model;

class Team
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $short_name;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $image_url;

    /**
     * @var int
     */
    private $id;

    public function __construct(
        int $id,
        string $short_name,
        string $name,
        string $image_url = null,
        string $code = null
    ) {
        $this->code       = $code;
        $this->short_name = $short_name;
        $this->name       = $name;
        $this->image_url  = $image_url;
        $this->id         = $id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getShortName(): string
    {
        return $this->short_name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
