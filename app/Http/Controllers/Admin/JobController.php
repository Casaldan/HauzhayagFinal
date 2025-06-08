// Make sure the location field is included in the validation and saving process
protected function validateJob($request)
{
    return $request->validate([
        'title' => 'required|string|max:255',
        'company' => 'required|string|max:255',
        'location' => 'required|string|max:255', // Make location required
        'description' => 'required|string',
        // other fields...
    ]);
}

// When saving the job, ensure location is included
public function store(Request $request)
{
    $data = $this->validateJob($request);
    $data['is_admin_posted'] = true; // Set as admin posted
    $data['status'] = 'approved'; // Auto-approve admin jobs
    
    JobListing::create($data);
    
    return redirect()->route('admin.jobs.index')->with('success', 'Job listing created successfully');
}