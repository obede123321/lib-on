<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\DatabaseService;
use App\Service\LibraryService;

class AiController extends AppController
{
    public function consult(): void
    {
        $answer = null;
        $question = '';

        if ($this->request->is('post')) {
            $question = trim((string)$this->request->getData('question'));

            if ($question === '') {
                $this->Flash->error('Digite uma pergunta para consultar a IA.');
            } else {
                $library = new LibraryService(new DatabaseService());
                $answer = $library->answerWithAssistantKnowledge($question);
                $library->saveAiConsultation($question, $answer);
                $this->Flash->success('Consulta realizada com sucesso.');
            }
        }

        $this->set(compact('answer', 'question'));
    }
}
