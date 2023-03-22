<?php

namespace App\Entity;

use App\Entity\Interface\DetailInterface;
use App\Entity\Trait\DetailTrait;
use App\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobRepository::class)]
class Job implements DetailInterface
{
    use DetailTrait;

    use DetailTrait {
        DetailTrait::__construct as private __detailConstruct;
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'jobs')]
    private Collection $tags;

    public function __construct()
    {
        $this->__detailConstruct();
        $this->tags = new ArrayCollection();
        $this->detail->setCreatedAt(new \DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }
}
