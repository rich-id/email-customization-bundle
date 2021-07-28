<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="RichId\EmailCustomizationBundle\Infrastructure\Repository\EmailConfigurationRepository")
 * @ORM\Table(
 *     name="module_email_customization_configuration",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="email_configuration_type_position_UNIQUE", columns={"type", "position"}),
 *     }
 * )
 */
class EmailConfiguration
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer", name="id", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false, length=255, unique=true, name="slug")
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false, length=255, unique=true, name="name")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="EmailConfigurationType", nullable=false, name="type")
     */
    protected $type;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false, name="position", options={"unsigned":true})
     */
    protected $position = 0;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=600, nullable=false, name="default_value")
     */
    protected $defaultValue;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=600, nullable=true, name="value")
     */
    protected $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=false, name="date_update")
     */
    protected $dateUpdate;

    public function getId(): int
    {
        return $this->id;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function getDateUpdate(): \DateTime
    {
        return $this->dateUpdate;
    }

    public function getValueToUse(): string
    {
        if ($this->value !== null && $this->value !== '') {
            return $this->value;
        }

        return $this->defaultValue;
    }
}
