<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

final class Product extends AbstractEntity
{
    protected string $additionalInformation = '';

    protected string $articleNumber = '';

    protected string $name = '';

    protected ?FileReference $image = null;

    public function getArticleNumber(): string
    {
        return $this->articleNumber;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAdditionalInformation(): string
    {
        return $this->additionalInformation;
    }

    public function getImage(): ?FileReference
    {
        return $this->image;
    }
}
