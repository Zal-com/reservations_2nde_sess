<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RepresentationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RepresentationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RepresentationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
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
        CRUD::setModel(\App\Models\Representation::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/representation');
        CRUD::setEntityNameStrings('representation', 'representations');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb(); // set columns from db columns.
        CRUD::addColumn([
            'name' => 'title',
            'label' => 'Show',
            'type' => 'select',
            'entity' => 'show',
            'attribute' => 'title',
            'model' => 'App\Models\Show'
        ]);
        CRUD::addColumn([
            'name' => 'id',
            'label' => 'Location',
            'type' => 'select',
            'entity' => 'location',
            'attribute' => 'designation',
            'model' => 'App\Models\Location'
        ]);
        CRUD::addColumn([
            'name' => 'when',
            'label' => 'Date / Heure',
            'type' => 'datetime',
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
        CRUD::setValidation(RepresentationRequest::class);
        //CRUD::setFromDb(); // set fields from db columns.
        CRUD::addField(
            [
                'label' => 'Show',
                'type' => 'select',
                'name' => 'show_id',
                'entity' => 'show',
                'model' => 'App\Models\Show',
                'attribute' => 'title'
            ]
        );
        CRUD::addField(
            [
                'label' => 'Location',
                'type' => 'select',
                'name' => 'location_id',
                'entity' => 'location',
                'model' => 'App\Models\Location',
                'attribute' => 'designation'
            ]
        );
        CRUD::addField(
            [
                'label' => 'Date & Heure',
                'type' => 'datetime',
                'name' => 'when',
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
}
