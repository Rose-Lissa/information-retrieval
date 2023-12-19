def pascal_triangle(n):
    if n <= 0 or not isinstance(n, int):
        print("Ошибка: введите целое положительное число.")
        return

    triangle = [[1]]

    for i in range(1, n):
        row = [1]
        prev_row = triangle[i - 1]
        for j in range(1, i):
            row.append(prev_row[j - 1] + prev_row[j])
        row.append(1)
        triangle.append(row)

    for row in triangle:
        print(' '.join([str(num) for num in row]))


n = int(input("Введите число n: "))
pascal_triangle(n)