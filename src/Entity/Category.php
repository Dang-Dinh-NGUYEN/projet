<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, mappedBy="category")
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

     public function __toString(){
                return $this->getCategory();
    }

     /**
      * @return Collection<int, Article>
      */
     public function getArticles(): Collection
     {
         return $this->articles;
     }

     public function addArticle(Article $article): self
     {
         if (!$this->articles->contains($article)) {
             $this->articles[] = $article;
             $article->addCategory($this);
         }

         return $this;
     }

     public function removeArticle(Article $article): self
     {
         if ($this->articles->removeElement($article)) {
             $article->removeCategory($this);
         }

         return $this;
     }

}