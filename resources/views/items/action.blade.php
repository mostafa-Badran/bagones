<a href="{{ url('items',$id) }}" class="btn btn-sm btn-clean btn-icon" title="View details">
    <i class="la la-eye"></i>
</a>
<a href="{{ url('items/edit',$id) }}" class="btn btn-sm btn-clean btn-icon" title="Edit details">
    <i class="la la-edit"></i>
</a>
<a href="javascript:void(0)" data-id="{{ $id }}" class="delete btn btn-sm btn-clean btn-icon" title="Delete">
    <i class="la la-trash"></i>
</a>
