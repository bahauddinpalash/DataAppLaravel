<?php

namespace App\Http\Controllers;

use App\Models\BdmLead;
use App\Models\Client;
use App\Models\Candidate;
use App\Models\RecruitLead;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // BDM Dashboard
    public function Bdmdashboard() { 
        $clients = Client::limit(5)->get(); 
        $leads = BdmLead::limit(5)->where('created_by', Auth::user()->name)->get();
        
        return view('bdm.dashboard', compact('clients', 'leads')); 
    }

    // Recruit Dashboard
    public function Recruitdashboard() { 
        $candidates = Candidate::limit(5)->get();  // Fetch Candidates
        $leads = RecruitLead::limit(5)->where('created_by', Auth::user()->name)->get();  // Fetch RecruitLeads

        return view('recruiter.dashboard', compact('candidates', 'leads')); 
    }

    // Admin Dashboard
    public function Admindashboard() {
        // Fetching clients, leads, BDM leads and other relevant data
        $clients = Client::limit(5)->get();  // Fetch recent 5 clients
        $bdmLeads = BdmLead::limit(5)->get();  // Fetch recent 5 BDM leads
        $recruitLeads = RecruitLead::limit(5)->get();  // Fetch recent 5 Recruiter leads
        $candidates = Candidate::limit(5)->get();  // Fetch recent 5 candidates

        // Admin can also get performance data or additional insights about BDM or Recruiters
        $bdmCount = BdmLead::count();  // Total number of BDM leads
        $recruitCount = RecruitLead::count();  // Total number of Recruit leads

        // You can add more metrics depending on what the admin needs to see

        return view('admin.dashboard', compact('clients', 'bdmLeads', 'recruitLeads', 'candidates', 'bdmCount', 'recruitCount'));
    }
}
