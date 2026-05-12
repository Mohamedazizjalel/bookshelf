<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'sefef')]
    private ?self $category = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'category')]
    private Collection $sefef;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $isbn = null;

    public function __construct()
    {
        $this->sefef = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?self
    {
        return $this->category;
    }

    public function setCategory(?self $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getSefef(): Collection
    {
        return $this->sefef;
    }

    public function addSefef(self $sefef): static
    {
        if (!$this->sefef->contains($sefef)) {
            $this->sefef->add($sefef);
            $sefef->setCategory($this);
        }

        return $this;
    }

    public function removeSefef(self $sefef): static
    {
        if ($this->sefef->removeElement($sefef)) {
            // set the owning side to null (unless already changed)
            if ($sefef->getCategory() === $this) {
                $sefef->setCategory(null);
            }
        }

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(?string $isbn): static
    {
        $this->isbn = $isbn;

        return $this;
    }
}
