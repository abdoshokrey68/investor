<!-- Button trigger modal -->
<button type="button" class="col-md-12 bold btn btn-primary h5" data-toggle="modal" data-target="#staticBackdrop">
    <i class="fas fa-user-md ml-2 mr-2"></i>
    Work with us now
</button>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Subscription information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="{{route('work.subscribe',$user->id)}}" class="btn btn-primary">
                Subscribe Now
            </a>
        </div>
    </div>
    </div>
</div>
