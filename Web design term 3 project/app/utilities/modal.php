<?php
namespace App\Utilities;

class Modal
{
    private $id;
    private $content;

    public function __construct($id, $content)
    {
        $this->id = $id;
        $this->content = $content;
    }

    public function render($isSucess = false)
    {
        $display = '<h5 class="modal-title text-xl font-bold text-green-700">Success</h5>';
        if (!$isSucess) {
            $display = '<h5 class="modal-title text-xl font-bold text-red-700">Error</h5>';
        }

        echo <<<HTML
        <style>
            .modal {
                transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
                transform: translateY(-20px);
                opacity: 0;
            }
            .modal:not(.hidden) {
                transform: translateY(0);
                opacity: 1;
            }
            .modal_box_container {
                color:black;
            }
        </style>
        <div id="{$this->id}" class="modal_box_container modal hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" role="dialog">
            <div class="modal-dialog relative top-1/4 mx-auto p-5 border w-1/3 shadow-lg rounded-md bg-white">
                <div class="modal-content">
                    <div class="modal-header flex justify-between items-center p-5 border-b">
                        {$display}
                        <button type="button" class="close text-red-500 text-2xl leading-none" onclick="this.closest('.modal').classList.add('hidden');" aria-label="Close">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body p-5">
                        <p>{$this->content}</p>
                    </div>
                    <div class="modal-footer flex justify-end p-5 border-t">
                        <button type="button" class="btn btn-success py-2 px-4 bg-green-500 text-white font-semibold rounded hover:bg-green-700" onclick="this.closest('.modal').classList.add('hidden');">OK</button>
                    </div>
                </div>
            </div>
        </div>
    HTML;
    }


}
