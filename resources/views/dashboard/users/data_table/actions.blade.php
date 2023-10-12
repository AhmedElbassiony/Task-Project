<div class="list-icons">
    <a href="{{ route('users.edit' , $id) }}"
       class="list-icons-item text-primary-800 pr-2"><i class="icon-pencil7"></i></a>
       <a href="{{ route('users.show.products' , $id) }}"
       class="list-icons-item text-dark-800 pr-2"><i class="icon-cart-add2"></i></a>
   <form action="{{ route('users.destroy' , $id) }}"
         method="post">
       @csrf
       @method('DELETE')
       <button type="submit" class="btn list-icons-item text-danger-800"
               style="padding: 0;background: transparent; color: red"
               onclick="return confirm('هل انت متاكدانك تريد حذف هذا المستخدم؟');">
            <i class="icon-trash"></i>
        </button>
   </form>
</div>

