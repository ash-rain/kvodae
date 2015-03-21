<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template;

class TemplateController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$templates = Template::all();
		return view('template.index', compact('templates'));
	}

	public function create()
	{
		return view('template.create');
	}
	
	public function store(Request $request)
	{
		$input = $request->only(['name', 'price']);
		$template = new Template;
		$template->fill($input);
		$template->save();
		return redirect(action('TemplateController@edit', $template->id));
	}

	public function show(Template $template)
	{
		return view('template.show', compact('template'));
	}
	
	public function edit(Template $template)
	{
		$fonts = ['serif', 'sans-serif', 'Times New Roman', 'Arial'];
		return view('template.edit', compact('template', 'fonts'));
	}
	
	public function update(Request $request, Template $template)
	{
		$input = $request->only(['name', 'price', 'draw_data']);
		$template->fill($input);
		$template->save();
		return redirect(action('TemplateController@index'));
	}
}
