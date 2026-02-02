<?php
namespace App\Controller\Admin;

use App\Repository\HabitsRepository;
use Mns\Buggy\Core\AbstractController;

class HabitsController extends AbstractController
{

    private HabitRepository $habitsRepository;

    public function __construct()
    {   
        $this->habitsRepository = new habitsRepository();
    }


    public function index()
    {
        $usehabitsrs = $this->habitsRepository->findAll();
        return $this->render('admin/habtis/index.html.php', [
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
                $errors['name'] = 'Le Nom est obligatoire';

            if(empty($habit['description']))
                $errors['description'] = 'La description est obligatoire';

            
            if(count($errors) == 0)
            {
                $id = $this->habitsRepository->insert($habit);
                header('Location: /admin/habits');
                exit;
            }
        }

        return $this->render('admin/habits/new.html.php', [
            'errors' => $errors,
        ]);
    }
}