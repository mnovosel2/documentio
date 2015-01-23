<?php
use Documentio\Repositories\Account\AccountInterface;

class RepositoriesController extends BaseController {

	/**
	 * Repository Repository
	 *
	 * @var Repository
	 */
	protected $repository;
    protected $user;

	public function __construct(Repository $repository, AccountInterface $user)
	{
		$this->repository = $repository;
        $this->user=$user;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $user=$this->user->getLoggedUser();
		$repositories = $this->repository->where('owner_id','=',$user->id)->get();

		return View::make('repositories.index', compact('repositories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('repositories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
        $user=$this->user->getLoggedUser();
        $input['tags']=$input['tags'];
        $input['owner_id']=$user->id;
		$validation = Validator::make($input, Repository::$rules);

		if ($validation->passes())
		{

			$this->repository->create($input);

			return Redirect::route('repositories.index');
		}

		return Redirect::route('repositories.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$repository = $this->repository->findOrFail($id);

		return View::make('repositories.show', compact('repository'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$repository = $this->repository->find($id);

		if (is_null($repository))
		{
			return Redirect::route('repositories.index');
		}

		return View::make('repositories.edit', compact('repository'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(),['_method','_token']);
		$input['owner_id']=$this->user->getLoggedUser()->id;
        $validation = Validator::make($input, Repository::$rules);

		if ($validation->passes())
		{
            $repo=$this->repository->find($id);
			$repo->update($input);

			return Redirect::route('repositories.show', $id);
		}

		return Redirect::route('repositories.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->repository->find($id)->delete();

		return Redirect::route('repositories.index');
	}

}
