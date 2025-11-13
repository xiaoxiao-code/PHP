# JavaScript 内置对象

JavaScript 提供了许多内置对象，它们构成了一个对象

# 1 对象体系
- 对象 (The Top Level)：
    - 这个对象体系的最高层是`window`对象，它代表设备窗口。
- 子对象（子对象）：
    - `window`对象包含了多个子对象，例如：
        - `document`(代表网页)
        - `history`（代表浏览器的历史记录）
        - `location`(代表当前页面的位置/URL)
    - 这些子对象（如`document`）和自己的属性和下一层的子对象（如`forms`、`images`、`links`）。
# 2 访问对象
- 访问原则：
    - 在访问一个对象时，上原则应该从华丽的`window`开始，由表及里逐次获取其子对象，直到访问到目标对象的状态。
- 译文：
    - 例如，将网页页面的背景颜色（`bgColor`属性）设置为蓝色的 JavaScript 语句为：
        `window.document.bgColor = "blue"`
- 简略`window`：
    - 在实际使用时，作为对象，`window`通常可以被简洁。因此，上面的示例也可以简单写为：
        `document.bgColor = "blue"`
