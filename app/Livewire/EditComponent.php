<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Fact;
use App\Models\Image;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


#[Layout('layouts.app')]
class EditComponent extends Component
{

    use WithFileUploads;

    public $childNotes;

    public int $id;

    public array $factPath = [];
    public array $selectedTagIds = [];

    public string $title = '';
    public string $subtitle = '';
    public string $text = '';
    public string $searchCategory = '';
    public string $searchTag = '';

    protected $listeners = ['moveNoteUp', 'moveNoteDown'];

    public ?int $selectedCategoryId = null;

    public bool $showImages = false;
    public bool $showSettings = false;
    public bool $showPathMenu = false;

    public $photo;
    public $thumbUpload;


    public function AutoSaveCatTag()
    {
        $this->saveTagsAndCategory();
    }

    public function updatedSelectedCategoryId()
    {
        $this->saveTagsAndCategory();
    }

    public function updatedSelectedTagIds()
    {
        $this->saveTagsAndCategory();
    }

    public function categoryChanged()
    {
        $this->saveTagsAndCategory();
    }

    public function tagsChanged()
    {
        $this->saveTagsAndCategory();
    }

    public function mount($id)
    {
        $this->id = $id;

        $fact = Fact::with('tags')->findOrFail($this->id);

        $this->title = $fact->title;
        $this->text = $fact->text ?? '';
        $this->selectedCategoryId = $fact->category_id;
        $this->selectedTagIds = $fact->tags->pluck('id')->toArray();
    }

    public function refreshNotes()
    {
        // Reload notes after moving
        $fact = Tag::with(['parent', 'notes.notes.notes'])->findOrFail($this->id);
        $this->childNotes = $fact->notes;
    }


    public function updatedThumbUpload()
    {
        $this->validate([
            'thumbUpload' => 'required|image|mimes:webp|max:2048',
        ]);

        $filename = uniqid() . '.webp';
        Storage::disk('thumbs')->putFileAs('', $this->thumbUpload, $filename);

        $fact = Tag::findOrFail($this->id);
        $fact->thumb = $filename;
        $fact->save();

        $this->reset('thumbUpload');
    }

    public function removeThumb()
    {
        $fact = Tag::findOrFail($this->id);

        if ($fact->thumb) {
            Storage::disk('thumbs')->delete($fact->thumb);
            $fact->thumb = null;
            $fact->save();
        }
    }



    public function autoSave($title, $subtitle, $text)
    {
        $fact = Fact::findOrFail($this->id);

        $updated = false;

        if ($fact->title !== $title) {
            $fact->title = $title;
            $fact->slug = Str::slug($title);
            $updated = true;
        }

        if ($fact->text !== $text) {
            $fact->text = $text;
            $updated = true;
        }

        if ($updated) {
            $fact->save();
            logger("✅ Fact #{$this->id} autosaved with changes.");
        } else {
            logger("ℹ️ No changes detected, skipped save.");
        }

        $this->saveTagsAndCategory();
    }

    public function updatedPhoto()
    {
        $this->uploadImage();
    }

    public function uploadImage()
    {
        $this->validate([
            'photo' => 'required|image|mimes:webp|max:10240',
        ]);

        $filename = Str::random(10) . '.webp';

        Storage::disk('images')->putFileAs('', $this->photo, $filename);

        Image::create([
            'fact_id' => $this->id,
            'name' => $filename,
        ]);

        $this->reset('photo');

        session()->flash('message', '✅ Image uploaded!');
    }

    public function deleteImage($imageId)
    {
        $image = Image::findOrFail($imageId);

        // Delete the file from disk
        Storage::disk('images')->delete($image->name);

        // Delete from database
        $image->delete();

        session()->flash('message', '🗑️ Image deleted!');
    }

    public function toggleImagePanel()
    {
        $this->showImages = !$this->showImages;
    }

    public function toggleSettings()
    {
        $this->showSettings = !$this->showSettings;
    }


    // Categories and Tags

    public function getFilteredCategoriesProperty()
    {

        logger('Search category string:', [$this->searchCategory]);
        return Category::where('name', 'like', '%' . $this->searchCategory . '%')->get();
    }

    public function getFilteredTagsProperty()
    {
        return Tag::where('name', 'like', '%' . $this->searchTag . '%')->get();
    }

    public function addCategory()
    {
        $name = trim($this->searchCategory);

        if ($name === '')
            return;

        $category = Category::create(['name' => $name]);
        $this->selectedCategoryId = $category->id;

        $this->searchCategory = ''; // clear input after add

        // 🧠 Trigger save after setting selected
        $this->AutoSaveCatTag();
    }


    public function addTag()
    {
        $name = trim($this->searchTag);

        if ($name === '')
            return;

        $tag = Tag::create(['name' => $name]);

        // Push clean ID
        $this->selectedTagIds = array_merge($this->selectedTagIds, [$tag->id]);

        $this->searchTag = ''; // clear input

        $this->AutoSaveCatTag();
    }


    public function toggleTag($id)
    {
        $id = (int) $id;

        if (in_array($id, $this->selectedTagIds)) {
            $this->selectedTagIds = array_values(array_diff($this->selectedTagIds, [$id]));
        } else {
            $this->selectedTagIds[] = $id;
        }
    }


    public function saveTagsAndCategory()
    {
        $fact = Fact::find($this->id);

        $this->dispatch('debugOutput', [
            'topic_id' => $this->id,
            'category_id' => $this->selectedCategoryId,
            'tag_ids' => $this->selectedTagIds,
        ]);

        if ($fact) {
            $fact->category_id = $this->selectedCategoryId;
            $fact->save();

            $fact->tags()->sync($this->selectedTagIds);
        }
    }

    public function deleteCategory($categoryId)
    {
        // Detach from all topics first
        \DB::table('topics_categories')->where('category_id', $categoryId)->delete();

        // Delete category itself
        Category::find($categoryId)?->delete();

        // If the deleted category was selected, clear it
        if ($this->selectedCategoryId === (int) $categoryId) {
            $this->selectedCategoryId = null;
            $this->categoryChanged();
        }
    }

    public function deleteTag($tagId)
    {
        // Detach from all topics first
        \DB::table('topics_tags')->where('tag_id', $tagId)->delete();

        // Delete tag itself
        Tag::find($tagId)?->delete();

        // Remove from selected if active
        $this->selectedTagIds = array_values(array_filter(
            $this->selectedTagIds,
            fn($id) => $id !== (int) $tagId
        ));

        $this->tagsChanged();
    }



    public function render()
    {
        return view('livewire.edit', [
            'fact' => Fact::findOrFail($this->id),
            'images' => Image::where('fact_id', $this->id)->get(),
            'filteredCategories' => $this->filteredCategories,
            'filteredTags' => $this->filteredTags,
        ]);
    }
}
