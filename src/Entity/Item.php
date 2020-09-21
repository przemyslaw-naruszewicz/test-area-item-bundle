<?php

namespace TestArea\ItemBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use TestArea\ItemBundle\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\NumericFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get", "patch", "delete"},
 *
 *     normalizationContext={"groups"={"item:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"item:write"}, "swagger_definition_name"="Write"},
 *     attributes={
 *          "pagination_items_per_page"=5,
 *          "route_prefix"="/test_area"
 *     }
 * )
 * @ApiFilter(RangeFilter::class, properties={"amount"})
 * @ApiFilter(NumericFilter::class, properties={"amount"})
 *
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 * @ORM\Table(name="items")
 */
class Item
{
    /**
     * @Groups({"item:read"})
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"item:read", "item:write"})
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=2,
     *     max=60,
     *     maxMessage="Name must have between 2-60 chars"
     * )
     */
    private $name;

    /**
     * @Groups({"item:read", "item:write"})
     *
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $amount;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return $this
     */
    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
