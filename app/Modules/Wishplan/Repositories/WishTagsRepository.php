<?php 
namespace App\Modules\Wishplan\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class WishTagsRepository extends Repository 
{

    public function model() 
    {
        return 'App\Modules\Wishplan\Models\WishTags';
    }

    /**
     * Find user associated wish tags
     *
     * @param int $id
     * @return array
     */
    public function findAllTags($id = null) 
    {
        $columns = ['id', 'name', 'is_checked'];

        $tags = $id 
            ? $this->findWhere(['user_id' => $id], $columns) 
            : $this->all($columns);

        $formmattedTags = [];
        foreach ($tags as $k => $v) {
            $formmattedTags[$v['id']]['value'] = $v['id'];
            $formmattedTags[$v['id']]['name'] = $v['name'];
            $formmattedTags[$v['id']]['checked'] = $v['is_checked'];
        }

        return $formmattedTags;
    }
}