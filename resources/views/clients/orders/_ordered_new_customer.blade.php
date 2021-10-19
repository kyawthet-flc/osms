<!-- PAGENO: OSMS-027 -->
<div class="col-md-12">
    <div class="modal micromodal-slide is-open" id="modal-1" aria-hidden="false">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" style="width:100%;" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                <h2 class="modal__title" id="modal-1-title">Add New Custoer</h2>
                <button onclick="window.location.href='{{ $modelCloseUrl }}'" class="modal__close" data-custom-close="modal-1" aria-label="Close modal" data-micromodal-close></a>
                </header>
                <main class="modal__content w-100" id="modal-1-content">
                    @include('clients.customers._form',[
                        'action' => route('customer.store'), 'method' => 'post', 'submitLabel' => 'Create', 'confirmationText' => 'Are you sure to create?','urlSegments' => ['code' => $code] ])
                </main>
                <footer class="modal__footer">
                <button onclick="window.location.href='{{ $modelCloseUrl }}'" class="modal__btn" data-custom-close="modal-1" data-micromodal-close aria-label="Close this dialog window">Cancel</button>
                </footer>
            </div>
        </div>
    </div>
</div>