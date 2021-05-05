<?php

declare(strict_types = 1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="pizza")
 * @ORM\Entity(repositoryClass="App\Repository\PizzaRepository")
 */
class Pizza
{
    /**
     * @var int
     * @ORM\Column(name="id_pizza", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private string $nom;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity=IngredientPizza::class, mappedBy="pizza")
     */
    private Collection $quantiteIngredients;

    /**
     * @ORM\OneToMany(targetEntity=IngredientPizza::class, mappedBy="pizza")
     */
    private $id_ingredientPizza;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->quantiteIngredients = new ArrayCollection();
        $this->id_ingredientPizza = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Pizza
     */
    public function setId(int $id): Pizza
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Pizza
     */
    public function setNom(string $nom): Pizza
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @param IngredientPizza $quantiteIngredients
     * @return Pizza
     */
    public function addQuantiteIngredients(IngredientPizza $quantiteIngredients): Pizza
    {
        $this->quantiteIngredients[] = $quantiteIngredients;

        return $this;
    }

    /**
     * @param IngredientPizza $quantiteIngredients
     */
    public function removeQuantiteIngredient(IngredientPizza $quantiteIngredients): void
    {
        $this->quantiteIngredients->removeElement($quantiteIngredients);
    }

    /**
     * @return Collection
     */
    public function getQuantiteIngredients(): Collection
    {
        return $this->quantiteIngredients;
    }

    /**
     * @return Collection|IngredientPizza[]
     */
    public function getIdIngredientPizza(): Collection
    {
        return $this->id_ingredientPizza;
    }

    public function addIdIngredientPizza(IngredientPizza $idIngredientPizza): self
    {
        if (!$this->id_ingredientPizza->contains($idIngredientPizza)) {
            $this->id_ingredientPizza[] = $idIngredientPizza;
            $idIngredientPizza->setPizza($this);
        }

        return $this;
    }

    public function removeIdIngredientPizza(IngredientPizza $idIngredientPizza): self
    {
        if ($this->id_ingredientPizza->removeElement($idIngredientPizza)) {
            // set the owning side to null (unless already changed)
            if ($idIngredientPizza->getPizza() === $this) {
                $idIngredientPizza->setPizza(null);
            }
        }

        return $this;
    }
}
