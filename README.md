### 安装

```phpregexp
composer require xiajianrong/laravel-develop-tools
```

### 需要使用关联查询的话安装

```phpregexp
composer require dcat/laravel-wherehasin
```

### 介绍

laravel开发过程中重复的代码例如查询和添加操作 数学计算 格式化返回数据等

### 示例

```
//数据库操作
$params = [
            'id'                    => $request->input('id'),
            'name|alias'            => ['like', $request->input('name')],
            'client_rel_tag.tag_id' => $request->input('tag_id'),
            'client_contacts.name'  => ['like', $request->input('contacts_name')],
            'created_at'            => ['between', $request->input('start_time'), $request->input('end_time')],
        ];
 return SpeedCurd::SearchLists(Client::query(), $params)->get();
 
 //根据ID判断是更新还是添加
 $params = [
            'id'   => $request->input('id'),
            'name' => $request->input('name'),
        ];
  return SpeedCurd::CreateOrUpdateById(Client::query(), $params);
  
  //根据条件判断是添加还是更新
  $params = [
            'attribute' => [
                'name' => $request->input('name'),
            ],
            'data'      => [
                'code' => $request->input('code'),
            ]
        ];
  return SpeedCurd::CreateOrUpdateByAttribute(Client::query(), $params);


//返回数据格式化

在controller.php 中使用 HttpResponse
use HttpRespone
//不分页返回
return $this->success($data);

//分页返回
return $this->successPaginate($data);

```

