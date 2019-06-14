<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    //
    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function trash() {


        // trash details
        $this->trashDetails();

        // trash reviews
        $this->trashReviews();

        // trash original products
        $this->trashSelf();
    }

    /**
     * Trash details of product.
     *
     * @return void
     */
    protected function trashDetails() {
        $this->delete();
    }

    protected function trashReviews() {
        # code...
    }

    /**
     * Trash the self product.
     *
     * @return void
     */
    protected function trashSelf() {
        $this->delete();
    }

}
