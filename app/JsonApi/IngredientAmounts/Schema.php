<?php

namespace App\JsonApi\IngredientAmounts;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'ingredient-amounts';

    /**
     * @inheritdoc
     */
    public function getId($resource): string
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param \App\Models\IngredientAmount $resource
     *
     * @return array
     */
    public function getAttributes($resource): array
    {
        return [
            'amount' => $resource->amount,
            'unit' => $resource->unit,
            'weight' => $resource->weight,
            'calories' => $resource->calories(),
            'carbohydrates' => $resource->carbohydrates(),
            'cholesterol' => $resource->cholesterol(),
            'fat' => $resource->fat(),
            'protein' => $resource->protein(),
            'sodium' => $resource->sodium(),
            'createdAt' => $resource->created_at,
            'updatedAt' => $resource->updated_at,
        ];
    }

    /**
     * @inheritdoc
     */
    public function getRelationships($resource, $isPrimary, array $includeRelationships): array
    {
        return [
            'ingredient' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::SHOW_DATA => isset($includeRelationships['ingredient']),
                self::DATA => function () use ($resource) {
                    return $resource->ingredient;
                },
            ],
            'recipe' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::SHOW_DATA => isset($includeRelationships['recipe']),
                self::DATA => function () use ($resource) {
                    return $resource->recipe;
                },
            ]
        ];
    }

}
