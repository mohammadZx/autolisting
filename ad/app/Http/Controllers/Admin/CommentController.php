<?php
/**
 * LaraClassifier - Classified Ads Web Application
 * Copyright (c) BeDigit. All Rights Reserved
 *
 * Website: https://laraclassifier.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from CodeCanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
 */

namespace App\Http\Controllers\Admin;

use App\Helpers\Files\Upload;
use App\Http\Controllers\Admin\Panel\PanelController;
use App\Http\Requests\Admin\CommentRequest as StoreRequest;
use App\Http\Requests\Admin\CommentRequest as UpdateRequest;

class CommentController extends PanelController
{
	public function setup()
	{
		/*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
		$this->xPanel->setModel('App\Models\Comment');
		$this->xPanel->setRoute(admin_uri('comments'));
		$this->xPanel->setEntityNameStrings(trans('admin.comment'), trans('admin.comments'));
		$this->xPanel->denyAccess(['create']);

		$this->xPanel->addButtonFromModelFunction('top', 'bulk_activation_btn', 'bulkActivationBtn', 'end');
		$this->xPanel->addButtonFromModelFunction('top', 'bulk_deactivation_btn', 'bulkDeactivationBtn', 'end');
		$this->xPanel->addButtonFromModelFunction('top', 'bulk_deletion_btn', 'bulkDeletionBtn', 'end');
		
		// Filters
		// -----------------------
		$this->xPanel->disableSearchBar();
		// -----------------------

		/*
		|--------------------------------------------------------------------------
		| COLUMNS AND FIELDS
		|--------------------------------------------------------------------------
		*/
		// COLUMNS
		$this->xPanel->addColumn([
			'name'      => 'id',
			'label'     => '',
			'type'      => 'checkbox',
			'orderable' => false,
		]);
		$this->xPanel->addColumn([
			'name'          => 'name',
			'label'         => trans('admin.Name'),
			'type'          => "model_function",
			'function_name' => 'getNameHtml',
		]);
		$this->xPanel->addColumn([
			'name'  => 'title',
			'label' => mb_ucfirst(trans('admin.title')),
			'type'          => "model_function",
			'function_name' => 'getTitleHtml',
		]);

		$this->xPanel->addColumn([
			'name'  => 'content',
			'label' => trans('admin.content')
		]);

		$this->xPanel->addColumn([
			'name'  => 'rate',
			'label' => trans('admin.rate')
		]);
	
		$this->xPanel->addColumn([
			'name'          => 'active',
			'label'         => trans('admin.Active'),
			'type'          => 'model_function',
			'function_name' => 'getActiveHtml',
			'on_display'    => 'checkbox',
		]);
		

		// FIELDS
		$this->xPanel->addField([
			'name'       => 'content',
			'label'      => trans('admin.content'),
			'type'       => 'text',
			'attributes' => [
				'placeholder' => trans('admin.content'),
			],
		]);

		$this->xPanel->addField([
			'name'              => 'rate',
			'label'             => trans('admin.rate'),
			'type'              => 'number',
			'attributes'        => [
				'placeholder' => trans('admin.rate'),
				'min' => '1',
				'max' => '5',
			]
		]);

		$this->xPanel->addField([
			'name'  => 'active',
			'label' => trans('admin.active'),
			'type'  => 'checkbox_switch',
		]);
	
	}
	
	public function store(StoreRequest $request)
	{	
		return parent::storeCrud();
	}
	
	public function update(UpdateRequest $request)
	{		

		return parent::updateCrud();
	}
	
}
