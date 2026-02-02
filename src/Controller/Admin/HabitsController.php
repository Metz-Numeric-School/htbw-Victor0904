<?php
namespace App\Controller\Admin;

use App\Repository\HabitRepository;
use Mns\Buggy\Core\AbstractController;

class HabitsController extends AbstractController
{

    private HabitRepository $habitRepository;

    public function __construct()
    {   
        $this->habitRepository = new habitRepository();
    }


    public function index()
    {
        $habits = $this->habitRepository->findAll();
        return $this->render('admin/habits/index.html.php', [
            'habits' => $habits,
        ]);
    }

        public function new()
    {
        $errors = [];

        if(!empty($_POST['habit']))
        {
            $habit = $_POST['habit'];
                        
            if(empty($habit['name']))
                $errors['name'] = 'Le nom est obligatoire';
            if(empty($habit['user_id']))
                $errors['user_id'] = 'Un utilisateur est obligatoire';

            if(empty($habit['description']))
                $errors['description'] = 'La description est obligatoire';
            
            if(count($errors) == 0)
            {
                $id = $this->habitRepository->insert($habit);
                header('Location: /admin/habit');
                exit;
            }
        }

        return $this->render('admin/habits/new.html.php', [
            'errors' => $errors,
        ]);
    }
}