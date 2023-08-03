<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LocationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LocationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LocationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as TraitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Location::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/location');
        CRUD::setEntityNameStrings('location', 'locations');
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
            'label' => 'Salle',
            'name' => 'designation',
        ]);

        CRUD::addColumn([
            'label' => 'Commune',
            'name' => 'locality_id',
            'model' => 'App\Models\Locality',
            'entity' => 'locality',
            'attribute' => 'locality_fr'
        ]);

        CRUD::addColumn([
            'label' => 'Adresse',
            'name' => 'address'
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
        CRUD::setValidation(LocationRequest::class);
        //CRUD::setFromDb(); // set fields from db columns.

        CRUD::addField(
            [
                'label' => 'Locality',
                'type' => 'select',
                'name' => 'locality_id',
                'entity' => 'locality',
                'model' => 'App\Models\Locality',
                'attribute' => 'postcode'
            ]
        );

        CRUD::addField(
            [
                'label' => 'Adresse',
                'type' => 'text',
                'name' => 'address',
            ]
        );

        CRUD::addField(
            [
                'label' => 'Salle',
                'type' => 'text',
                'name' => 'designation',
            ]
        );

        CRUD::addField(
            [
                'label' => 'Site web',
                'type' => 'url',
                'name' => 'website',
            ]
        );

        CRUD::addField(
            [
                'label' => 'Téléphone',
                'type' => 'text',
                'name' => 'phone',
            ]
        );

        CRUD::addField(
            [
                'label' => 'Slug',
                'type' => 'hidden',
                'name' => 'slug',
            ]
        );



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

    protected function store(){

        $this->crud->getRequest()['slug'] = $this->slugify($this->crud->getRequest()['designation']);

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
