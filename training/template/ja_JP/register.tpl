<form action="." method="post">
<h2>会員登録</h2>
   <p>
     メールアドレス: <input type="text" name="mailaddress" value="{$form.mailaddress}">{message name="mailaddress"}</input>
   </p>
   <p>
     パスワード: <input type="password" name="password" value="{$form.password}">{message name="password"}</input>
   </p>
   <p>
     パスワード（確認用）: <input type="password" name="password_confirm" "{$form.password_confirm}">{message name="password_confirm"}</input>
   </p>
   <ul>
     <li>
       6文字以上
     </li>
     <li>
       必ず英字、数字をそれぞれ含む
     </li>
   </ul>
   <input type="submit" name="action_register_do" value="登録"/>
   <p>
     <a href="?action_entry=true">メニュー一覧</a>
   </p>
</form>
