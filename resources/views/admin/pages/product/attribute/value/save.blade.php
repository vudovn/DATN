@extends('admin.layout')

@section('template')
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <x-form :config="$config" :model="$attribute ?? null">
        <div class="mt-20">
            <div class="row">
                <div class="col-lg-5">
                    <div class="panel-body">
                        <h2>General Information</h2>
                        <p class="text-14">- Enter the general information of the user</p>
                        <p class="text-14">- Note: Field marked with <span class="text-danger">(*)</span> are required </p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row mb-15">
                                <div class="col-lg-6">
                                    <x-input :label="'Tên thuộc tính'" :name="'name'" :value="$attribute->name ?? ''" :require="true" />
                                </div>
                            </div>
                            @if (isset($config['method']) && $config['method'] !== 'edit')
                            @endif
                        </div>
                    </div>
                    <div class="text-left mb-15 mt-3">
                        <x-button :label="'Save'" :class="'btn-success'" />
                    </div>
                </div>
            </div>
        </div>
    </x-form>
@endsection
