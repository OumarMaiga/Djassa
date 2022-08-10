<?php

    namespace App\Repositories;

    abstract class ResourceRepository {
        protected $model;
        
        public function get() {
            return $this->model->get();
        }
        
        public function getBy($name, $operator, $value) {
            return $this->model->where($name, $operator, $value)->get();
        }

        public function store(Array $inputs) {
            return $this->model->create($inputs);
        }

        public function getById($id) {
            return $this->model->findOrFail($id);
        }

        public function update($id, Array $inputs) {
            return $this->getById($id)->fill($inputs)->save();
        }

        public function destroy($id) {
            $this->getById($id)->delete();
        }

        public function deleteBy($name, $value) {
            return $this->model->where($name, $value)->delete();
        }
    }