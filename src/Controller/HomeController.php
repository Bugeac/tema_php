<?php

namespace App\Controller;

use App\Model\Company;
use App\Model\CompanyRepository;

class HomeController extends Controller
{
    public function index()
    {
        $repo = new CompanyRepository;
        $companies = $repo->findAll('company');
        $this->render('home', [
            'companies' => $companies,
        ]);
    }

    public function add()
    {
        $company = new Company;
        $repo = new CompanyRepository;
        if ($this->request->is('post')) {
            $company->bindValues($this->request->data);
            $company->validate();
            if (empty($company->errors)) {
                if ($repo->save($company->getName(), $company->getDate(), $company->getVat())) {
                    $this->redirect('/');
                }
            }
        }
        $this->render('add', [
            'company' => $company,
        ]);
    }
}