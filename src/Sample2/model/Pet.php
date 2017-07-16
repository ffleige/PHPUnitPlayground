<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 15.07.17
 * Time: 22:19
 */

namespace FrankFleige\PHPUnitPlayground\Sample2\model;


class Pet
{
    /**
     * the pets id
     * @var int
     */
    private $id;

    /**
     * category the pet belongs to
     * @var Category
     */
    private $category;

    /**
     * the pets name
     * @var string
     */
    private $name;

    /**
     * urls of pets photos
     * @var string[]
     */
    private $photoUrls;

    /**
     * tags associated with the pet
     * @var Tag[]
     */
    private $tags;

    /**
     * the pets sale status
     * @var string
     */
    private $status;

    /**
     * Pet constructor.
     * @param int $id
     * @param Category $category
     * @param string $name
     * @param string[] $photoUrls
     * @param Tag[] $tags
     * @param string $status
     */
    public function __construct($id, Category $category, $name, array $photoUrls, array $tags, $status)
    {
        $this->id = $id;
        $this->category = $category;
        $this->name = $name;
        $this->photoUrls = $photoUrls;
        $this->tags = $tags;
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Pet
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return Pet
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Pet
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return \string[]
     */
    public function getPhotoUrls()
    {
        return $this->photoUrls;
    }

    /**
     * @param \string[] $photoUrls
     * @return Pet
     */
    public function setPhotoUrls(array $photoUrls)
    {
        $this->photoUrls = $photoUrls;
        return $this;
    }

    /**
     * @return Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param Tag[] $tags
     * @return Pet
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Pet
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
        return $this;
    }
}