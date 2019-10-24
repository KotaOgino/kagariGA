// $(function() {
// var addSite = $('#kagariGA').attr('addSite');
// console.log(addSite);
// var app = new Vue({
//   el: '#app',
// data: {
//   todos: [],
//   number: 'aaa',
// },
// methods: {
//   fetchTodos: function(){
//       axios.get('/api/get').then((res)=>{
//           this.todos = res.data
//       });
//   }
// },
// created(){
//   this.fetchTodos();
// }
// });

// var todo = new Vue({
//     el: '#app',
//     data: {
//         list: [],   // 入力テキストを入れる配列
//         last: null, // 入力テキストの最終更新日
//     },
// });
// getMessages(true); // 初回起動
//
// function getMessages() {
//   var name = 'kota';
//     $.ajaxSetup({
//         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
//     });
//
//     // Ajaxによる非同期通信
//     $.ajax({
//         type: 'GET',
//         url: '/api/test',
//         dataType: 'json',
//         data: {
//           index: JSON.stringify(name),
//          }
//     }).done(function(data) {
//         // 成功したら返り値をaddMessage()に入れて起動させる
//         alert('メッセージの取得に成功しました。');
//         console.log(data);
//         addMessage(data);
//
//     }).fail(function(jqXHR, textStatus, errorThrown) {
//         alert('メッセージの取得に失敗しました。');
//         console.log("ajax通信に失敗しました");
//         console.log(name);
//         console.log("jqXHR          : " + jqXHR.status);     // HTTPステータスが取得
//         console.log("textStatus     : " + textStatus);       // タイムアウト、パースエラー
//     });
//
// };
//
// function addMessage(data) {
//     todo.list.push(data);
// }
// });
