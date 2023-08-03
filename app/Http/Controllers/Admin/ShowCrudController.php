<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ShowRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use BackpackImport\ImportOperation;

/**
 * Class ShowCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ShowCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as TraitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use ImportOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Show::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/show');
        CRUD::setEntityNameStrings('show', 'shows');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // set columns from db columns.
        CRUD::addColumn([
            'name' => 'id',
            'label' => 'Location',
            'type' => 'select',
            'entity' => 'location',
            'attribute' => 'designation',
            'model' => 'App\Models\Location'
        ]);
        CRUD::addColumn([
            'name' => 'title',
            'label' => 'Titre',
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name' => 'description',
            'label' => 'Synopsis',
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name' => 'price',
            'label' => 'Prix',
            'type' => 'decimal',
        ]);

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ShowRequest::class);
        //CRUD::setFromDb(); // set fields from db columns.

        CRUD::addField(
            [
                'label' => 'Location',
                'type' => 'select',
                'name' => 'location_id',
                'entity' => 'location',
                'model' => 'App\Models\Location',
                'attribute' => 'designation',
                'tab' => 'Show'
            ]
        );
        CRUD::addField(
            [
                'label' => 'Titre',
                'type' => 'text',
                'name' => 'title',
                'tab' => 'Show'
            ]
        );
        CRUD::addField(
            [
                'label' => 'Synopsis',
                'type' => 'textarea',
                'name' => 'description',
                'tab' => 'Show'
            ]
        );
        CRUD::addField(
            [
                'label' => 'Poster',
                'type' => 'upload',
                'name' => 'poster_url',
                'withFiles' => true,
                'tab' => 'Show'
            ]
        );
        CRUD::addField(
            [
                'label' => 'Price',
                'type' => 'number',
                'name' => 'price',
                'tab' => 'Show'
            ]
        );
        CRUD::addField(
            [
                'label' => 'Bookable',
                'type' => 'boolean',
                'name' => 'bookable',
                'tab' => 'Show'
            ]
        );

        CRUD::addField(
            [
                'label' => 'Slug',
                'type' => 'hidden',
                'name' => 'slug',
            ]
        );

        CRUD::addField([
            'label' => 'Comédiens',
            'name' => 'id',
            'type' => 'select_multiple',
            'attribute' => 'full_name',
            'entity' => 'artisttypes',
            'model' => 'App\Models\Artist',
            'tab' => 'Artistes'
        ]);

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function store()
    {

        $this->crud->getRequest()['slug'] = $this->slugify($this->crud->getRequest()['title']);

        $response = $this->TraitStore();
        return $response;
    }

    function slugify($text)
    {
        // Strip html tags
        $text=strip_tags($text);
        // Replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // Transliterate
        setlocale(LC_ALL, 'en_US.utf8');
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // Remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // Trim
        $text = trim($text, '-');
        // Remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // Lowercase
        $text = strtolower($text);
        // Check if it is empty
        if (empty($text)) { return 'n-a'; }
        // Return result
        return $text;
    }
}
