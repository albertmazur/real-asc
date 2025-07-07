<!-- Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">{{ __('modal.confirm_delete_title') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('modal.close') }}"></button>
      </div>
      <div class="modal-body">
        {{ __('modal.confirm_delete_text') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('modal.cancel') }}</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">{{ __('modal.confirm') }}</button>
      </div>
    </div>
  </div>
</div>
