

<div class="list-icons">
    <a href="{{ route('admins.edit' , $id) }}"
       class="list-icons-item text-primary-600 pr-2"><i class="icon-pencil7"></i></a>
   <form action="{{ route('admins.destroy' , $id) }}"
         method="post">
       @csrf
       @method('DELETE')
       <button type="submit" class="btn list-icons-item text-danger-600"
               style="padding: 0;background: transparent; color: red"
               onclick="return confirm('هل انت متاكدانك تريد حذف هذا المسئول؟');">
            <i class="icon-trash"></i>
        </button>
   </form>
</div>
