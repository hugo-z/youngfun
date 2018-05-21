<?php

namespace App\Modules\Wishplan\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Wishplan\Repositories\WishTagsRepository as WishTagRepo;

class ApiController extends Controller
{
    private $wishTagRepo;
    /**
     * Construction function
     */
    public function __construct(WishTagRepo $wishTagRepo)
    {
        $this->wishTagRepo = $wishTagRepo;
    }

    public function voiceRecord($id = null)
    {
        dd($id);
    }

    public function noteRecord()
    {

    }

    /**
     * Add wish tags
     *
     * @return void
     */
    public function addTags()
    {

    }

    /**
     * Get all user created tags
     * @param int $user_id
     * @return json
     */
    public function getAllWishTags($user_id = null) 
    {
        $tags = $this->wishTagRepo->findAllTags($user_id);

        return response()->json($tags);
    }
}
