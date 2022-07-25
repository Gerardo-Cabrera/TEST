<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Minicli\Curly\Client;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SendPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Post Command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $crawler = new Client();
        $headers = [
            'User-Agent: curly 0.1',
        ];
        $data = array();

        try {
            $response = $crawler->post('https://atomic.incfile.com/fakepost',$data ,$headers);
            
            if ($response['code'] !== 200) {
                $this->error('Error while contacting the dev.to API.');
                
                return Command::FAILURE;
            }

            $responseData = json_decode($response['body'], true);
        } catch (\Throwable $th) {
            $this->error("Command Not Found.");
        }

    }
}
