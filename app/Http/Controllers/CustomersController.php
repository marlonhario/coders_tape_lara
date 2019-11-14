<?php

namespace App\Http\Controllers;


use App\Customer;
use App\Company;
use App\Events\NewCustomerHasRegisteredEvent;
use App\Mail\WelcomeNewUserMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CustomersController extends Controller
{

	public function __construct() {
        // $this->middleware('auth')->except(['index']);
		// $this->middleware('auth')->only(['index']);
		$this->middleware('auth');
	}

    public function index() {
    	// $activeCustomers = Customer::active()->get();
    	// $inactiveCustomers = Customer::inactive()->get();

        // $customers = Customer::all();
    	$customers = Customer::with('company')->paginate(15);  //good approach
    	return view('customers.index', compact('customers'));
    }

    public function create() {
    	$companies = Company::all();
    	$customer = new Customer();

    	return view('customers.create', compact('companies', 'customer'));
    }

    public function store() {

        $this->authorize('create', Customer::class); //for policy purpose

    	$customer = Customer::create($this->validateRequest());

        $this->storeImage($customer);

        event(new NewCustomerHasRegisteredEvent($customer));
        // Mail::to($customer->email)->send(new WelcomeNewUserMail());

        //Register to newsletter

        //Stack notification to admin

    	return redirect('customers');
    }

    public function show(Customer $customer) {
    	// $customer = Customer::where('id', $customer)->firstOrFail();

    	return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer) {
    	$companies = Company::all();
    	return view('customers.edit', compact('customer', 'companies'));
    }

    public function update(Customer $customer) {

    	$customer->update($this->validateRequest());

        $this->storeImage($customer);

    	return redirect('customers/'. $customer->id);
    }

    public function destroy(Customer $customer) {
        $this->authorize('create', Customer::class);
        
    	$customer->delete();

    	return redirect('customers');
    }

    protected function validateRequest() {

        return request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'active' => 'required',
            'company_id' => 'required',
            'image' => 'sometimes|file|image|max:5000'
        ]);

    }

    private function storeImage($customer) {
        if(request()->has('image')) {
            $customer->update([
                'image' => request()->image->store('uploads', 'public')
            ]);

            $image = Image::make(public_path('storage/' . $customer->image))->fit(300, 300);
            // $image = Image::make(public_path('storage/' . $customer->image))->crop(300, 300);
            // $image = Image::make(public_path('storage/' . $customer->image))->fit(300, 300, null, 'top-left');
            $image->save();
        }
    }
}
