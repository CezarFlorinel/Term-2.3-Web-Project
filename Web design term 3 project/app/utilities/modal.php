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

    public function render()
    {
        echo <<<HTML
            <div id="{$this->id}" class="modal" tabindex="-1" role="dialog" style="display:none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close text-danger" data-bs-dismiss="modal" aria-label="Close" style="float:left;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title">Error</h5>
                        </div>
                        <div class="modal-body">
                            <p>{$this->content}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
    }

}
