<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category_id;
    public function render()
    {
        $categories = Category::paginate(5);
        return view('livewire.admin.category.index', compact('categories'));
    }


    public function deleteCategory($id_category)
    {
        $this->category_id = $id_category;
    }
    
    public function destroyCategory()
    {
        $category = Category::find($this->category_id);
        $category->delete();
        Session()->flash('message', 'Category deleted!');
        $this->dispatchBrowserEvent('close-modal');
    }
}
