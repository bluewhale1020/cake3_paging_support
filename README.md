[![CakePHP 3](https://img.shields.io/badge/Version-CakePhp%203-brightgreen.svg?style=flat-square)](http://cakephp.org)
<img src="https://img.shields.io/badge/license-MIT-green.svg?style=flat-square" alt="license">

# PagingSupportComponent  For CakePHP3

## 概要 ##
cakePHP3で、ページング時に検索条件を引き継ぐためのコンポーネントです。
元々[cakephpのページング時の検索条件の引き継ぎ](https://realid-inc.com/column/2013/08/13-140407)で公開されているコードを、CakePHP3でも動作するように
カスタマイズしました。

<hr>

## インストール ##

[CakePHP3](https://cakephp.org/)フレームワークのプロジェクトの`src/Controller/Component`フォルダ内に`dist/PagingSupportComponent.php`ファイルを設置します。

<hr>

## 利用方法 ##

以下のように関連ファイルに追記します。

**コンポーネントのインポート**

```php
    public function initialize()
    {
        parent::initialize();
		//PagingSupport の追加
        $this->loadComponent('PagingSupport');
        //
    }
```

**コントローラー内で呼び出し**

```php
    public function index()
    {
        //コンポーネントを呼び出す文を追加
        $this->PagingSupport->inheritPostData();
        //
        
     	if(!empty($this->request->data)){
        	//検索条件処理等...            
        }
        $users = $this->paginate($query);
        $this->set(compact('users'));        
        
    }
```

**`$paginate` コントローラー変数に`paramType`を追加**

```php
$this->paginate = [
 //paramTypeをquerystringに設定
 'paramType' => 'querystring'
 //
];
```

**ビューの中で`Paginator`のオプションに`usePaging`パラメータを追加**

```php
<ul class="pagination">
    <?php
    //optionsのurlにusePagingパラメータを追加
    $this->Paginator->options(['url'=> ['action'=>'index','usePaging'=>1]]); 
	//
	?>            
    <?= $this->Paginator->first('<< ' . __('最初')) ?>
    <?= $this->Paginator->prev('< ' . __('前')) ?>
    <?= $this->Paginator->numbers() ?>
    <?= $this->Paginator->next(__('次') . ' >') ?>
    <?= $this->Paginator->last(__('最後') . ' >>') ?>
</ul>
```

<hr>

## コンポーネント内の処理

- 検索時に検索条件のリクエストデータをセッションに保存
- ページング利用時にセッションから検索条件を読み取りリクエストデータに保存
- 上記以外にセッションデータを削除

### usePagingパラメータについて

上記2番目のページング利用の判断に使いますが、コンポーネント内では、リクエストパラムの"?"キー内に
あるので、`request->params['?']['usePaging']`でアクセスしています。

<hr>

## 参考URL

[cakephpのページング時の検索条件の引き継ぎ](https://realid-inc.com/column/2013/08/13-140407)

