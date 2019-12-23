<?php 

namespace App\Traits;

trait CreateSlug{
    
    protected $whereCondition = array();

    public function getWhereCondition($whereCondition){
        $this->whereCondition=$whereCondition;
    }

    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
        
        $allSlugs = $this->getRelatedSlugs($slug, $id);

        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return self::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->when(!empty($this->whereCondition),function($query){
                    $query->where($this->whereCondition);   
            })
            ->get();
    }
}